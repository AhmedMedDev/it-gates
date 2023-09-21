FROM node:latest

WORKDIR /var/www/

COPY . .

RUN npm install
RUN npm run build
RUN npm run generate

EXPOSE 3000

ENV NUXT_HOST=0.0.0.0

ENV NUXT_PORT=3000

CMD [ "npm", "run", "start" ]