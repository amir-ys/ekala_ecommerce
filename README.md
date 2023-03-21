#Laravel ecommerce System
<p align="center ">
</p>

## About This Project

This project is a ecommerce project developed with Laravel framework in modular structure. Each feature in this application developed in an isolated module, such as:

- Products Module.
  - Attribute Module.
  - AttributeGroup Module.
  - Brand Module.
  - Category Module.
- Role and Permissions Module.
- Payment Module,
- Coupon Module.
- Slide Module,
- Comment Module,
- Cart Module,
- Setting Module,
- Core Module,
- Front Module,
- Dashboard Module.
- Notification Module,
- OTP Module,
- Blog Module,
etc...

## Installation
```
git clone https://github.com/amir-ys/ekala_ecommerce.git
run composer install
run php artisan key:generate
run php artisan migrate --seed
run php artisan serve
```


## Installation with docker

```
git clone https://github.com/amir-ys/ekala_ecommerce.git
run docker compose up --build
```

### Demo users
```
Admin:
username: admin@ekala.com
password: 123456

viewer: 
username: viewer@ekala.com
password: 123456
```

## License

This application is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
