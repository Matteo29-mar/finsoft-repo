FROM node:14

WORKDIR /app

COPY server.js .
CMD ["node", "server.js"]

EXPOSE 5001