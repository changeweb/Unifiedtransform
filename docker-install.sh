if ! [ -x "$(command -v docker-compose)" ]; then
    echo 'docker-compose is not installed on your machine' >&2
    sleep 1
    echo 'Installing docker-compose'
    sleep 1
    sudo curl -L "https://github.com/docker/compose/releases/download/1.27.4/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
    sudo chmod +x /usr/local/bin/docker-compose
    sleep 1
fi

echo "Scaffolding your app using Docker... This will take a while..."
sleep 1
sudo docker-compose up -d
sudo docker-compose run --rm composer install
sudo docker-compose run --rm artisan migrate:fresh --seed

sleep 1
