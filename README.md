Piclodio
========

Raspberry Pi Web Clock Rado Web Server app

Server side application.
More informations here => http://mespotesgeek.fr/?p=267

![My image](sispheor.github.com/Piclodio/img/piclodio_android.png)


Installation
==========

Web server
```
sudo apt-get install apache2 php5 libapache2-mod-php5
```

Multimédia player
```
sudo apt-get install mplayer
```

Update the Apache privilege
```
sudo visudo
```
and add this line at the end of the file
```
www-data ALL=NOPASSWD:/usr/bin/mplayer* ,/usr/bin/pgrep mplayer ,/usr/bin/killall mplayer
```

Get the last archive
```
wget https://github.com/Sispheor/Piclodio/archive/master.zip
```
Unzip it
```
unzip master.zip
```

Put it in your web server folder
```
sudo mv Piclodio-master/ /var/www/piclodio
```

Give privilege to Apache on the folder
```
sudo chown -R www-data:www-data /var/www/piclodio
```

You can now use the app in your web broswer http://raspPi_IP/piclodio
