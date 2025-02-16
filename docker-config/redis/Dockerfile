# Use the official Redis image as a base
FROM redis:latest

# Copy the redis.conf file into the container
COPY redis.conf /usr/local/etc/redis/redis.conf

# Run the Redis server with the custom configuration file
CMD ["redis-server", "/usr/local/etc/redis/redis.conf"]
