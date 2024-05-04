# Use an official PHP runtime as a parent image
FROM php:8.0-cli

# Set the working directory in the container to the root
WORKDIR /

# Copy the source code directly into the root directory of the container
COPY . .

# List files in the root directory to verify the structure
RUN ls -la

# Specify the command to run your application, making sure it is in the root
CMD ["php", "src/Index.php"]