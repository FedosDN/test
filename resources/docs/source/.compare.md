---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://wezomtest.local/docs/collection.json)

<!-- END_INFO -->

#City


<!-- START_53be1e9e10a08458929a2e0ea70ddb86 -->
## Get all cities

> Example request:

```bash
curl -X GET \
    -G "http://wezomtest.local/" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://wezomtest.local/"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`GET /`


<!-- END_53be1e9e10a08458929a2e0ea70ddb86 -->

<!-- START_a824fc42f761eee232ba6010c8f7641d -->
## Search cities

> Example request:

```bash
curl -X POST \
    "http://wezomtest.local/search" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://wezomtest.local/search"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "county_id": 1,
            "name": "Adjuntas",
            "zip": "00601",
            "lat": "18.18004",
            "lng": "-66.75218",
            "zcta": 1,
            "parent_zcta": "",
            "population": "17242",
            "density": "111.4",
            "imprecise": 0,
            "military": 0,
            "timezone": "America\/Puerto_Rico",
            "created_at": "2020-06-02T17:20:32.000000Z",
            "updated_at": "2020-06-02T17:20:32.000000Z"
        }
    ],
    "first_page_url": "http:\/\/wezomtest.local\/search?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http:\/\/wezomtest.local\/search?page=1",
    "next_page_url": null,
    "path": "http:\/\/wezomtest.local\/search",
    "per_page": 20,
    "prev_page_url": null,
    "to": 1,
    "total": 1
}
```

### HTTP Request
`POST search`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `phrase` |  required  | Search phrase (zipcode or name)
    `page` |  optional  | integer

<!-- END_a824fc42f761eee232ba6010c8f7641d -->

<!-- START_41838147eda11004f599b0936bc10988 -->
## Get cities with pagination

> Example request:

```bash
curl -X POST \
    "http://wezomtest.local/paginate" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://wezomtest.local/paginate"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "county_id": 1,
            "name": "Adjuntas",
            "zip": "00601",
            "lat": "18.18004",
            "lng": "-66.75218",
            "zcta": 1,
            "parent_zcta": "",
            "population": "17242",
            "density": "111.4",
            "imprecise": 0,
            "military": 0,
            "timezone": "America\/Puerto_Rico",
            "created_at": "2020-06-02T17:20:32.000000Z",
            "updated_at": "2020-06-02T17:20:32.000000Z"
        }
    ],
    "first_page_url": "http:\/\/wezomtest.local\/paginate?page=1",
    "from": 1,
    "last_page": 33099,
    "last_page_url": "http:\/\/wezomtest.local\/paginate?page=33099",
    "next_page_url": "http:\/\/wezomtest.local\/paginate?page=2",
    "path": "http:\/\/wezomtest.local\/paginate",
    "per_page": 1,
    "prev_page_url": null,
    "to": 1,
    "total": 33099
}
```

### HTTP Request
`POST paginate`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `page` |  optional  | integer

<!-- END_41838147eda11004f599b0936bc10988 -->

#File


<!-- START_375b6ed787a8d24b073d51fb7401b9dd -->
## File

Upload CSV file to update data

> Example request:

```bash
curl -X POST \
    "http://wezomtest.local/upload" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"csv":"quo"}'

```

```javascript
const url = new URL(
    "http://wezomtest.local/upload"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "csv": "quo"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST upload`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `csv` | File |  required  | Mimes:csv
    
<!-- END_375b6ed787a8d24b073d51fb7401b9dd -->


