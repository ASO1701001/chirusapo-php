# タイムライン取得
> [GET] /timeline/get
## パラメーター

|   Param  | Require |
|:--------:|:-------:|
|   token  |   Yes   |
| group_id |   Yes   |
## レスポンス
### 成功時
> このAPIは成功した場合、タイムライン情報を返します  
> また `data > timeline_data > (?) > content_type` により投稿タイプを調べる必要があります  
```JSON
{
    "status": 200,
    "message": null,
    "data": {
        "timeline_data": [
            {
                "id": "*id*",
                "user_id": "*user_id*",
                "user_name": "*user_name*",
                "user_icon": "*user_icon*",
                "content_type": "text",
                "text": "*text*",
                "post_time": "*post_time*"
            },
            {
                "id": "*id*",
                "user_id": "*user_id*",
                "user_name": "*user_name*",
                "user_icon": "*user_icon*",
                "content_type": "image",
                "image01": "*image01*",
                "image02": "*image02*",
                "image03": "*image03*",
                "image04": "*image04*",
                "post_time": "*post_time*"
            },
            {
                "id": "*id*",
                "user_id": "*user_id*",
                "user_name": "*user_name*",
                "user_icon": "*user_icon*",
                "content_type": "text_image",
                "text": "*text*",
                "image01": "*image01*",
                "image02": "*image02*",
                "image03": "*image03*",
                "image04": "*image04*",
                "post_time": "*post_time*"
            },
            {
                "id": "*id*",
                "user_id": "*user_id*",
                "user_name": "*user_name*",
                "user_icon": "*user_icon*",
                "content_type": "movie",
                "movie01_thumbnail": "*movie01_thumbnail*",
                "movie01_content": "*movie01_content*",
                "post_time": "*post_time*"
            },
            {
                "id": "*id*",
                "user_id": "*user_id*",
                "user_name": "*user_name*",
                "user_icon": "*user_icon*",
                "content_type": "text_movie",
                "text": "*text*",
                "movie01_thumbnail": "*movie01_thumbnail*",
                "movie01_content": "*movie01_content*",
                "post_time": "*post_time*"
            }
        ]
    }
}
```
### 失敗時
> このAPIは失敗した場合、以下のエラーを返します

| ErrorCode | Comment |
|:-:|:-:|
| REQUIRED_PARAM | 値が不足している場合に返されます |
| VALIDATION_GROUP_ID | バリデーションに失敗した場合に返されます |
| UNKNOWN_TOKEN | ログイントークンの検証に失敗した場合に返されます |
| UNKNOWN_GROUP | グループ情報が見つからない場合に返されます |
| UNREADY_BELONG_GROUP | グループに所属していない場合に返されます |
``` JSON
{
    "status": 400,
    "message": [
        "REQUIRED_PARAM",
        "VALIDATION_GROUP_ID",
        "UNKNOWN_TOKEN",
        "UNKNOWN_GROUP",
        "UNREADY_BELONG_GROUP",
    ],
    "data": null
}
```