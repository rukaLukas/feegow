# FROM node:16.15.0
FROM node:20.10

# RUN npm install -g http-server

WORKDIR /app

RUN npm install -g npm@10.8.3

COPY package.json .

RUN npm install --legacy-peer-deps && chown -R node /app/node_modules

COPY . .

RUN npm run build

ENTRYPOINT [ "./entrypoint.sh" ]

#EXPOSE 5173
