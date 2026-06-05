FROM node:22-alpine

WORKDIR /app

RUN corepack enable

COPY package.json yarn.lock* ./
RUN yarn install --frozen-lockfile || yarn install

COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

COPY . .

EXPOSE 5173

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["yarn", "dev", "--host", "0.0.0.0"]
