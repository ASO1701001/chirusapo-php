# タイムラインコメント削除
> [POST] /timeline/comment/delete
## パラメーター

|   Param  | Require |
|:--------:|:-------:|
|   token  |   Yes   |
| comment_id |   Yes   |
## レスポンス
### 成功時
> このAPIは成功した場合、コメント情報を削除します
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
| UNKNOWN_COMMENT                    | コメント情報が見つからない場合に返されます                       |
| UNAUTHORIZED_OPERATION                    | 自分が投稿した内容ではないコメントを削除しようとした場合に返されます                           |
``` JSON
{
    "status": 400,
    "message": [
        "REQUIRED_PARAM",
        "UNKNOWN_TOKEN",
        "UNKNOWN_COMMENT",
        "UNAUTHORIZED_OPERATION"
    ],
    "data": null
}
```