# マスターデータ取得
> [GET] /start/master-download
## パラメーター
> このAPIは引数を受け取ることはありません
## レスポンス
### 成功時
> このAPIは、予防接種名・アレルギー名を返します
```JSON
{
    "status": 200,
    "message": null,
    "data": {
        "vaccination": [
            "Hib(ヒブ)ワクチン",
            "..."
        ],
        "allergy": [
            "ハウスダスト1 ",
            "..."
        ]
    }
}
```
### 失敗時
> このAPIはstatusが200番以外になることはありません
