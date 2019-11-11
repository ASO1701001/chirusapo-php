# 所属メンバー取得
> [GET] /group/belong-member
## パラメーター

| Param | Require |
|:-:|:-:|
| token | Yes |
| group_id | Yes |
## レスポンス
### 成功時
> このAPIは成功した場合、グループに所属しているメンバー情報を返します
> また、ユーザーアイコンが登録されていない場合、`data > belong_member > user_icon` にはnullが返されます
```JSON
{
    "status": 200,
    "message": null,
    "data": {
        "belong_member": [
            {
                "user_id": "*user_id*",
                "user_name": "*user_name*",
                "user_icon": "*user_icon*"
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
| UNREADY_BELONG_GROUP | 取得しようとしたユーザーがグループに所属していない場合に返されます |
``` JSON
{
    "status": 400,
    "message": [
        "REQUIRED_PARAM",
        "VALIDATION_GROUP_ID",
        "UNKNOWN_TOKEN",
        "UNKNOWN_GROUP",
        "UNREADY_BELONG_GROUP"
    ],
    "data": null
}
```