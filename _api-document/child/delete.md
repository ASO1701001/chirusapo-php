# 子ども情報削除
> [POST] /child/delete
## パラメーター

|   Param  | Require |
|:--------:|:-------:|
|   token  |   Yes   |
| child_id |   Yes   |
## レスポンス
### 成功時
> このAPIは成功した場合、子ども情報を削除します
```JSON
{
    "status": 200,
    "message": null,
    "data": null
}
```
### 失敗時
> このAPIは失敗した場合、以下のエラーを返します

| ErrorCode | Comment |
|:-:|:-:|
| REQUIRED_PARAM | 値が不足している場合に返されます |
| UNKNOWN_TOKEN | ログイントークンの検証に失敗した場合に返されます |
| UNKNOWN_CHILD | 情報が見つからない場合に返されます |
| UNREADY_BELONG_GROUP | グループに所属していない場合に返されます |
``` JSON
{
    "status": 400,
    "message": [
        "REQUIRED_PARAM",
        "UNKNOWN_TOKEN",
        "UNKNOWN_CHILD",
        "UNREADY_BELONG_GROUP"
    ],
    "data": null
}
```