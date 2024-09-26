docker build --platform linux/amd64 -t khuong123/wordpress:dev_6 .

docker run --platform linux/amd64 -dp 80:8080 --name wp --rm khuong123/wordpress:dev_5

docker push khuong123/wordpress:dev_6

docker pull khuong123/wordpress:dev_6


# Nếu như có lỗi không cập nhật volume thì nên xóa volume đi

# RUN rm -rf /var/www/html/wp-content
# COPY src/wp-content /var/www/html/wp-content

docker


docker compose exec wordpress sh

chmod -R 777 ./

docker compose exec wordpress sh -c "cd /var/www/html/wp-content && chmod -R 777 ./

docker compose up --remove-orphans --build -d