# タイムライン削除
> [POST] /timeline/delete
## パラメーター

|   Param  | Require |
|:--------:|:-------:|
|   token  |   Yes   |
| timeline_id |   Yes   |
## レスポンス
### 成功時
> このAPIは成功した場合、投稿情報を削除します
```JSON
{
    "status": 200,
    "message": null,
    "data": null
}
```
### 失敗時
> このAPIは失敗した場合、以下のエラーを返します

|             ErrorCode            |                              Comment                             |
|:--------------------------------:|:----------------------------------------------------------------:|
|          REQUIRED_PARAM          |                 値が不足している場合に返されます                 |
|           UNKNOWN_TOKEN          |         ログイントークンの検証に失敗した場合に返されます         |
| UNKNOWN_POST                    | 投稿情報が見つからない場合に返されます                       |
| UNREADY_BELONG_GROUP             | グループに所属していない場合に返されます                         |
| UNAUTHORIZED_OPERATION                    | 自分が投稿した内容ではない場合に返されます                           |
``` JSON
{
    "status": 400,
    "message": [
        "REQUIRED_PARAM",
        "UNKNOWN_TOKEN",
        "UNKNOWN_POST",
        "UNREADY_BELONG_GROUP",
        "UNAUTHORIZED_OPERATION"
    ],
    "data": null
}
```