# Article API

## Tech stacks

- laravel 8
- mariadb 10
- redis
- php7.3 | 8

## Installasi

1. Clone project
   ```https://github.com/brianrizqi/Article-API.git```
2. Install vendor
   ```composer install```
3. Copy .env.example menjadi .env
4. Isi value .env untuk keperluan database
5. lakukan command ```php artisan key:generate```
6. lakukan command ```php artisan migrate```

## API Reference

Tambahkan item dibawah ini untuk header ketika menembak api

```dotenv
Accept : application/json
```

Untuk mengirim data menggunakan format json. contoh dapat dilihat dibawah

```json
{
    "data": {
        "attributes": {
            "name": "Lorem psum dolor sit amet"
        }
    }
}
```

#### Category - Index

```http
  GET /api/v1/category
```

#### Category - Store

```http
  POST /api/v1/category
```

| Parameter | Type     | Description         |
|:----------| :------- |:--------------------|
| `name`    | `string` | **Required,Unique** |

#### Category - Show

```http
  POST /api/v1/category/{slug}
```

| Parameter | Type     | Description                             |
|:----------| :------- |:----------------------------------------|
| `slug`    | `string` | **Required**, menggunakan slug bukan id |

#### Category - Update

```http
  PUT /api/v1/category/{id}/edit
```

| Parameter | Type      | Description                           |
|:----------|:----------|:--------------------------------------|
| `id`      | `integer` | **Required**, menggunakan id category |
| `name`    | `string`  | **Required,Unique**                   |

#### Category - Delete

```http
  DELETE /api/v1/category/{slug}
```

| Parameter | Type     | Description                             |
|:----------| :------- |:----------------------------------------|
| `slug`    | `string` | **Required**, menggunakan slug bukan id |

#### Article - Index

```http
  GET /api/v1/article
```

| Parameter | Type     | Description                                                                               |
|:----------| :------- |:------------------------------------------------------------------------------------------|
| `category`    | `string` | **Nullable**, menggunakan slug category untuk mengambil article berdasarkan slug category |

#### Article - Store

```http
  POST /api/v1/article
```

| Parameter     | Type     | Description                           |
|:--------------| :------- |:--------------------------------------|
| `category_id` | `string` | **Required**, menggunakan category id |
| `title`       | `string` | **Required**                          |
| `description` | `string` | **Required**                          |
| `content`     | `string` | **Required**                          |

#### Article - Show

```http
  POST /api/v1/article/{slug}
```

| Parameter | Type     | Description                             |
|:----------| :------- |:----------------------------------------|
| `slug`    | `string` | **Required**, menggunakan slug bukan id |

#### Article - Update

```http
  PUT /api/v1/article/{slug}/edit
```

| Parameter | Type      | Description                              |
|:----------|:----------|:-----------------------------------------|
| `slug`    | `string` | **Required**, menggunakan slug bukan id  |
| `category_id` | `string` | **Required**, menggunakan category id |
| `title`       | `string` | **Required**                          |
| `description` | `string` | **Required**                          |
| `content`     | `string` | **Required**                          |

#### Article - Delete

```http
  DELETE /api/v1/article/{slug}
```

| Parameter | Type     | Description                             |
|:----------| :------- |:----------------------------------------|
| `slug`    | `string` | **Required**, menggunakan slug bukan id |
