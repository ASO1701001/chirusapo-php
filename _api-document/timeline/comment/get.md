# タイムラインコメント取得
> [GET] /timeline/comment/get
## パラメーター

|   Param  | Require |
|:--------:|:-------:|
|   token  |   Yes   |
| timeline_id |   Yes   |
## レスポンス
### 成功時
> このAPIは成功した場合、タイムライン情報を返します    
```JSON
{
    "status": 200,
    "message": null,
    "data": {
        "timeline_data": {
            
        },
        "comment_data": [
            {
                "id": "*id*",
                "user_id": "*user_id*",
                "user_name": "*user_name*",
                "user_icon": "*user_icon*",
                "comment": "*comment*",
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
| UNKNOWN_TOKEN | ログイントークンの検証に失敗した場合に返されます |
| UNKNOWN_POST | 投稿情報が見つからない場合に返されます |
| UNREADY_BELONG_GROUP | グループに所属していない場合に返されます |
``` JSON
{
    "status": 400,
    "message": [
        "REQUIRED_PARAM",
        "UNKNOWN_TOKEN",
        "UNKNOWN_POST",
        "UNREADY_BELONG_GROUP",
    ],
    "data": null
}
```