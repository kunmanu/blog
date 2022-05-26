use blog;

create user if not exists 'blogdev@localhost'
    identified by 'blogdevpass';

grant all on blog.* to 'blogdev@localhost' ;

flush privileges;