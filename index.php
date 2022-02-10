<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>条件入力</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.8.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <div id="main">
        <form action="data_create.php" method="POST" id="set">
            <a href="data_output.php">条件履歴画面</a>
            <div>
                <button>submit</button>
            </div>
            <p>分析①トレンドを選んでください。</p>
        </form>
        <div class="wrap" id="w2">
            <div class="trend">
                <div class="move green" id="trend_up">
                    上昇トレンド
                </div>
                <div class="move green" id="trend_down">
                    下落トレンド
                </div>
                <div class="move green" id="trend_range">
                    レンジ
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {

            // $(".custom-select").each(function() {
            //     var classes = $(this).attr("class"),
            //         id = $(this).attr("id"),
            //         name = $(this).attr("name");
            //     var template = '<div class="' + classes + '">';
            //     template += '<span class="custom-select-trigger">' + $(this).attr("placeholder") + '</span>';
            //     template += '<div class="custom-options">';
            //     $(this).find("option").each(function() {
            //         template += '<span class="custom-option ' + $(this).attr("class") + '" data-value="' + $(this).attr("value") + '">' + $(this).html() + '</span>';
            //     });
            //     template += '</div></div>';

            //     $(this).wrap('<div class="custom-select-wrapper"></div>');
            //     $(this).hide();
            //     $(this).after(template);
            // });
            // $(".custom-option:first-of-type").hover(function() {
            //     $(this).parents(".custom-options").addClass("option-hover");
            // }, function() {
            //     $(this).parents(".custom-options").removeClass("option-hover");
            // });
            // $(".custom-select-trigger").on("click", function() {
            //     $('html').one('click', function() {
            //         $(".custom-select").removeClass("opened");
            //     });
            //     $(this).parents(".custom-select").toggleClass("opened");
            //     event.stopPropagation();
            // });
            // $(".custom-option").on("click", function() {
            //     $(this).parents(".custom-select-wrapper").find("select").val($(this).data("value"));
            //     $(this).parents(".custom-options").find(".custom-option").removeClass("selection");
            //     $(this).addClass("selection");
            //     $(this).parents(".custom-select").removeClass("opened");
            //     $(this).parents(".custom-select").find(".custom-select-trigger").text($(this).text());
            // });
        });
        //HTMLの読み込みが終わった後、処理開始
        $(window).load(function() {

            let cnt = 0;
            // ドロップした時に呼ばれる関数。
            // ドロップされたら、落とされた要素の内容を自身に追加してみる。
            function drop_callback(event, ui) { // ドロップした時に呼ばれる関数。
                //flex用のdivをセット
                $("#set").append('<div class = "yoko"></div>');
                $(".yoko").append(ui.draggable.clone()); // cloneしないと元の要素がdrop後に消える。
                if ($(".yoko div:last").get(0).className.split(" ")[0] === "move") {
                    if ($(".yoko div:last").attr("id") === "trend_up") {
                        $(".yoko div:last").removeAttr("id");
                        $(".yoko div:last").attr("id", "trendup_input");
                        //phpのPOST用にINPUT用意
                        $("#set").append('<input type="hidden" name=' + $(".yoko div:last").attr("id").slice(0, 5) + ' value=1>');
                    } else if ($(".yoko div:last").attr("id") === "trend_down") {
                        $(".yoko div:last").removeAttr("id");
                        $(".yoko div:last").attr("id", "trenddown_input");
                        //phpのPOST用にINPUT用意
                        $("#set").append('<input type="hidden" name=' + $(".yoko div:last").attr("id").slice(0, 5) + ' value=2>');
                    } else if ($("#set div:last").attr("id") === "trend_range") {
                        $(".yoko div:last").removeAttr("id");
                        $(".yoko div:last").attr("id", "trendrange_input");
                        //phpのPOST用にINPUT用意
                        $("#set").append('<input type="hidden" name=' + $(".yoko div:last").attr("id").slice(0, 5) + ' value=3>');
                    }

                    //判断基準のセレクトボックス追加
                    $(".yoko").append('<select class = "kizyun" name = "kizyun" required>' +
                        '<option value="">-判断基準選択-</option>' +
                        '<option value="0">ローソク足</option>' +
                        '<option value="1">MA</option>' +
                        '<option value="2">MTF MA</option>' +
                        '</select>');
                    // $(".yoko").append('<div class = "center"><select class = "custom-select kizyun" name = "kizyun" required>' +
                    //     '<option value="">-判断基準選択-</option>' +
                    //     '<option value="candle">ローソク足</option>' +
                    //     '<option value="ma">MA</option>' +
                    //     '<option value="mtf">MTF MA</option>' +
                    //     '</select></div>');
                    $("#set").append('<div class = "yoko_2"></div>');
                    $(".yoko_2").append('<div class="volatility move_c tgreen">ボラリティ（勢い）</div>');
                    $(".yoko_2").append('<select class = "vola" name = "Vola" required>' +
                        '<option value="">-判断基準選択-</option>' +
                        '<option value="0">pips</option>' +
                        '<option value="1">強弱</option>' +
                        '</select>');
                }
            }

            $(".move").draggable({
                helper: 'clone',
                opacity: 0.5,
                revert: "invalid"
            });
            $(".move2").draggable({
                helper: 'clone',
                opacity: 0.5,
                revert: "invalid"
            });
            $(".move3").draggable({
                helper: 'clone',
                opacity: 0.5,
                revert: "invalid"
            });
            $("#set").droppable({
                drop: drop_callback
            });


            //トレンドの判断基準が変更になったときの処理
            $("#set").on("change", ".kizyun", function() {
                const k_val = $(".kizyun").val();
                let i = 0;

                if (k_val === "0") {

                } else if (k_val === "1") {
                    for (i = $(".yoko").children().length; i > 1; i--) {
                        $(".yoko").children("div:nth-child(" + i + ")").remove();
                        $(".yoko").children("input:nth-child(" + i + ")").remove();
                    }
                    $(this).closest("div").append('<input class ="input_num" type="number" name="input_ma" placeholder="MA">');
                    $(this).closest("div").append('<div>MA</div>');
                    $(this).closest("div").append('<div class= "plus_btn shadow">＋</div>');
                } else if (k_val === "2") {
                    for (i = $(".yoko").children().length; i > 1; i--) {
                        $(".yoko").children("div:nth-child(" + i + ")").remove();
                        $(".yoko").children("input:nth-child(" + i + ")").remove();
                    }
                    $(this).closest("div").append('<input class ="input_num" type="number" name="input_mtf" placeholder="MTF">');
                    $(this).closest("div").append('<div>MTF MA</div>');
                    $(this).closest("div").append('<div class= "plus_btn shadow">＋</div>');
                }
            });

            //ボラリティの判断基準が変更になったときの処理
            $("#set").on("change", ".vola", function() {
                const k_val = $(".vola").val();
                let i = 0;

                if (k_val === "0") {
                    for (i = $(".yoko_2").children().length; i > 2; i--) {
                        $(".yoko_2").children("div:nth-child(" + i + ")").remove();
                        $(".yoko_2").children("input:nth-child(" + i + ")").remove();
                        $(".yoko_2").children("select:nth-child(" + i + ")").remove();
                    }
                    $(this).closest("div").append('<input class ="input_num40" type="number" name="input_pips" placeholder="pips">');
                    $(this).closest("div").append('<div>pips</div>');
                } else if (k_val === "1") {
                    for (i = $(".yoko_2").children().length; i > 2; i--) {
                        $(".yoko_2").children("div:nth-child(" + i + ")").remove();
                        $(".yoko_2").children("input:nth-child(" + i + ")").remove();
                        $(".yoko_2").children("select:nth-child(" + i + ")").remove();
                    }
                    $(this).closest("div").append('<select class = "stren" name = "strong" required>' +
                        '<option value="">-強さ-</option>' +
                        '<option value="1">大</option>' +
                        '<option value="0">中</option>' +
                        '<option value="-1">小</option>' +
                        '</select>');
                }
            });
            //プラスボタンの処理
            $("#set").on("click", ".plus_btn", function() {
                const k_val = $(".kizyun").val();
                if (k_val === "0") {

                } else if (k_val === "1") {
                    $(this).removeClass("plus_btn");
                    $(this).addClass("minus_btn");
                    $(this).text("－");
                    $(this).parent().append('<input class ="input_num" type="number" name="input_ma" placeholder="MA">');
                    $(this).parent().append('<div>MA</div>');
                    $(this).parent().append('<div class= "plus_btn shadow">＋</div>');
                } else if (k_val === "2") {
                    $(this).removeClass("plus_btn");
                    $(this).addClass("minus_btn");
                    $(this).text("－");
                    $(this).parent().append('<input class ="input_num" type="number" name="input_mtf" placeholder="MTF">');
                    $(this).parent().append('<div>MTF MA</div>');
                    $(this).parent().append('<div class= "plus_btn shadow">＋</div>');
                }
            });
            //マイナスボタンの処理
            $("#set").on("click", ".minus_btn", function() {
                $(this).prev().prev().remove();
                $(this).prev().remove();
                $(this).remove();
            });

        });
    </script>

</body>

</html>