FROM node:22 AS build

WORKDIR /app

# Copia package.json e package-lock.json primeiro
COPY . .

RUN npm install

RUN npm install @angular/cli -g

EXPOSE 4200

CMD ["ng", "serve", "--host", "0.0.0.0"]
