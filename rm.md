docker build --platform linux/amd64 -t khuong123/wordpress:dev_1 .

docker run --platform linux/amd64 -dp 80:8080 --name wp --rm khuong123/wordpress:dev_1

docker push khuong123/wordpress:dev_1

docker pull khuong123/wordpress:dev_1


