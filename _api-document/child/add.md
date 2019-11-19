# 子ども情報登録
> [POST] /child/add
## パラメーター

|   Param  | Require |
|:--------:|:-------:|
|   token  |   Yes   |
| group_id |   Yes   |
| user_id |   Yes   |
| user_name |   Yes   |
| birthday |   Yes   |
| age |   Yes   |
| gender |   Yes   |
| blood_type |   Yes   |
| body_height |   Yes   |
| body_weight |   Yes   |
| clothes_size |   Yes   |
| shoes_size |   Yes   |
| vaccination[i][vaccine_name] |   No   |
| vaccination[i][visit_date] |   No   |
| allergy[i] |   No   |
| user_icon |   Yes   |
## レスポンス
### 成功時
> このAPIは成功した場合、子ども情報を返します
```JSON
{
    "status": 200,
    "message": null,
    "data": {
        "timeline_data": {
             "user_id": "*user_id*",
             "user_name": "*user_name*",
             "birthday": "*birthday*",
             "gender": "*gender*",
             "blood_type": "*blood_type*",
             "user_icon": "*user_icon*",
             "body_height": "*body_height*",
             "body_weight": "*body_weight*",
             "clothes_size": "*clothes_size*",
             "shoes_size": "*shoes_size*",
             "vaccination": [
                 {
                     "id": "*id*",
                     "vaccine_name": "*vaccine_name*",
                     "visit_date": "*visit_date*"
                 }
             ],
             "allergy": [
                 {
                     "id": "*id*",
                     "allergy_name": "*allergy_name*"
                 }
             ]
         }
    }
}
```
### 失敗時
> このAPIは失敗した場合、以下のエラーを返します

| ErrorCode | Comment |
|:-:|:-:|
| REQUIRED_PARAM | 値が不足している場合に返されます |
| UNKNOWN_TOKEN | ログイントークンの検証に失敗した場合に返されます |
| UNKNOWN_GROUP | グループ情報が見つからない場合に返されます |
| UNREADY_BELONG_GROUP | グループに所属していない場合に返されます |
| VALIDATION_USER_ID |   バリデーションに失敗した場合に返されます |
| VALIDATION_USER_NAME | バリデーションに失敗した場合に返されます |
| VALIDATION_BIRTHDAY | バリデーションに失敗した場合に返されます |
| VALIDATION_AGE | バリデーションに失敗した場合に返されます |
| VALIDATION_GENDER | バリデーションに失敗した場合に返されます |
| VALIDATION_BLOOD_TYPE | バリデーションに失敗した場合に返されます |
| VALIDATION_BODY_HEIGHT | バリデーションに失敗した場合に返されます |
| VALIDATION_BODY_WEIGHT | バリデーションに失敗した場合に返されます |
| VALIDATION_CLOTHES_SIZE | バリデーションに失敗した場合に返されます |
| VALIDATION_SHOES_SIZE | バリデーションに失敗した場合に返されます |
| VALIDATION_VACCINATION | バリデーションに失敗した場合に返されます |
| VALIDATION_ALLERGY | バリデーションに失敗した場合に返されます |
| ALLOW_EXTENSION | アップロードできないファイルがアップロードされた場合に返されます |
| UPLOAD_FAILED | アップロードに失敗した場合に返されます |
| ALREADY_USER_ID | 既にユーザーIDが登録されている場合に返されます |
``` JSON
{
    "status": 400,
    "message": [
        "REQUIRED_PARAM",
        "UNKNOWN_TOKEN",
        "UNKNOWN_GROUP",
        "UNREADY_BELONG_GROUP",
        "VALIDATION_USER_ID",
        "VALIDATION_USER_NAME",
        "VALIDATION_BIRTHDAY",
        "VALIDATION_AGE",
        "VALIDATION_GENDER",
        "VALIDATION_BLOOD_TYPE",
        "VALIDATION_BODY_HEIGHT",
        "VALIDATION_BODY_WEIGHT",
        "VALIDATION_CLOTHES_SIZE",
        "VALIDATION_VACCINATION",
        "VALIDATION_ALLERGY",
        "ALLOW_EXTENSION",
        "UPLOAD_FAILED",
        "ALREADY_USER_ID"
    ],
    "data": null
}
```