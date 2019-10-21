# アカウント情報変更
> [POST] /account/edit
## パラメーター

| Param | Require |
|:-:|:-:|
| token | Yes |
| user_icon | No |
| user_name | No |
| line_id | No |
| introduction | No |
## レスポンス
### 成功時
> このAPIは成功した場合、ユーザー基本情報を返します  
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
            "user_icon": "*user_icon*",
            "introduction": "*introduction*",
            "line_id": "*line_id*"
        }
    }
}
```
### 失敗時
> このAPIは失敗した場合、以下のエラーを返します  
> エラーが発生した場合、他の正規表現に成功した場合でもデータベースの情報が変更されることはありません

|        ErrorCode        |                                  Comment                                 |
|:-----------------------:|:------------------------------------------------------------------------:|
|      REQUIRED_PARAM     |                     値が不足している場合に返されます                     |
|      UNKNOWN_TOKEN      |             ログイントークンの検証に失敗した場合に返されます             |
| VALIDATION_USER_NAME    | バリデーションに失敗した場合に返されます                                 |
|    VALIDATION_LINE_ID   |                 バリデーションに失敗した場合に返されます                 |
| VALIDATION_INTRODUCTION | バリデーションに失敗した場合に返されます                                 |
| ALLOW_EXTENSION         | アップロードできないファイルがアップロードされようとした場合に返されます |
| UPLOAD_FAILED           | アップロードに失敗した場合に返されます                                   |
``` JSON
{
    "status": 400,
    "message": [
        "REQUIRED_PARAM",
        "UNKNOWN_TOKEN",
        "VALIDATION_USER_NAME",
        "VALIDATION_LINE_ID",
        "VALIDATION_INTRODUCTION",
        "ALLOW_EXTENSION",
        "UPLOAD_FAILED"
    ],
    "data": null
}
```