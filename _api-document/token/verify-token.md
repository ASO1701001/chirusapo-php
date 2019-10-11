# ログイントークン検証
> [POST] /token/verify-token
## パラメーター
| Param | Require |
|:-:|:-:|
| token | Yes |
## レスポンス
### 成功時
> このAPIは成功した場合、ユーザー基本情報・所属しているグループ情報を返します
> また、ユーザーアイコンが登録されていない場合、`data > user_info > user_icon` にはnullが返されます
```JSON
{
    "status": 200,
    "message": null,
    "data": {
        "user_info": {
            "user_id": "*user_id*",
            "user_name": "*user_name*",
            "email": "*email*",
            "user_icon": "*user_icon*"
        },
        "belong_group": [
            {
                "group_id": "*group_id*",
                "group_name": "*group_name*", 
            }
        ]
    }
}
```
### 失敗時
> このAPIは失敗した場合、以下のエラーを返します

| ErrorCode | Comment |
|:-:|:-:|
| REQUIRED_PARAM | 値が不足している場合に返されます<br>REQUIRED_PARAMが返された場合、ログイントークンの検証が行われることはありません |
| UNKNOWN_TOKEN | ログイントークンの検証に失敗した場合返されます |
``` JSON
{
    "status": 400,
    "message": [
        "REQUIRED_PARAM",
        "UNKNOWN_TOKEN"
    ],
    "data": null
}
```