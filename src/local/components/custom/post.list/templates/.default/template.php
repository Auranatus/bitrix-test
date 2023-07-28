<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (empty($arResult['POSTS'])) { ?>
    <h2>Посты не найдены</h2>
<?php } else {
    $votes = $APPLICATION->IncludeComponent(
        'custom:votes',
        '.default',
        [
            'POST_IDS' => array_column($arResult['POSTS'], 'ID')
        ]
    );
?>
    <div id="message" style="display: none;"></div>

    <?php foreach ($arResult['POSTS'] as $post) { ?>
    <div>
        <div>
            <h2><?= $post['UF_NAME'] ?></h2>
        </div>
        <br>
        <div>
            <div style="width: 20%; display: inline-block;">Кол-во голосов: <span class="votes_count"><?= $votes['VOTES_COUNT'][$post['ID']] ?? 0 ?></span></div>
            <form style="display: inline-block;" class="vote_form">
                <input type="hidden" name="post_id" value="<?= $post['ID'] ?>">
                <input type="submit" name="save_vote" value="Проголосовать">
            </form>
        </div>
    </div>
    <?php } ?>
    <br>
    <?php
    $APPLICATION->IncludeComponent(
        "bitrix:main.pagenavigation",
        "",
        array(
            "NAV_OBJECT" => $arResult['NAV'],
            "SEF_MODE" => "N",
        ),
        false
    );
    ?>
<style>
    .success {
        color: green;
    }
    .error {
        color: red;
    }
</style>
<script>
    $(document).ready(function () {
        let isAjax = false;
        $('.vote_form').on('submit', function (e) {
            e.preventDefault();

            if (!isAjax) {
                $.ajax({
                    url: '/',
                    dataType: 'json',
                    type: 'POST',
                    data: {"save_vote": true, "post_id": $(this).find('[name="post_id"]').val()},
                    beforeSend: function () {
                        isAjax = true;
                    },
                    complete: function () {
                        isAjax = false;
                    },
                    success: function (data) {
                        if (data.success) {
                            $('#message').addClass('success').removeClass('error');
                            let count = $(e.target).prev('div').find('.votes_count').text();
                            $(e.target).prev('div').find('.votes_count').text(parseInt(count) + 1);
                        } else {
                            $('#message').addClass('error').removeClass('success');
                        }

                        $('#message').text(data.message).show();
                        setTimeout(function () {
                            $('#message').fadeOut();
                        }, 3000);
                    }
                });
            }
        });
    });
</script>
<?php }
