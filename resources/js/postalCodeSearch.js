$(document).ready(function() {
    $('#search-postcode').on('click', function() {
        var postCode = $('#post_code').val().replace(/[^0-9]/g, ''); // 郵便番号の数字部分を取り出す

        if (postCode.length === 7) {
            // zipcloud APIを使って郵便番号から住所を取得
            $.ajax({
                url: 'https://zipcloud.ibsnet.co.jp/api/search',
                data: { zipcode: postCode },
                dataType: 'json',
                success: function(data) {
                    if (data.results) {
                        var address = data.results[0];
                        // 住所を挿入する
                        $('#address').val(address.address1 + address.address2 + address.address3);
                    } else {
                        alert("住所が見つかりませんでした。");
                    }
                },
                error: function() {
                    alert("郵便番号の検索に失敗しました。");
                }
            });
        } else {
            alert("有効な郵便番号を入力してください。");
        }
    });
});
