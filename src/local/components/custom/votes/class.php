<?php


class VotesComponent extends CBitrixComponent
{
    public $entityClass;

    public function executeComponent()
    {
        $hlBlock = \Bitrix\Highloadblock\HighloadBlockTable::getById(VOTES_HL_BLOCK_ID)->fetch();
        $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlBlock);
        $this->entityClass = $entity->getDataClass();

        if ($this->request->get('save_vote')) {
            $this->saveVote();
        }

        try {
            $this->arResult['VOTES_COUNT'] = $this->getVotesCount();
        } catch (\Throwable $e) {
            $this->arResult['VOTES_COUNT'] = [];
        }

        $this->includeComponentTemplate();

        return $this->arResult;
    }

    public function getVotesCount()
    {
        $table = $this->entityClass::getTableName();
        $postId = implode(',', $this->arParams['POST_IDS']);

        $query = <<<SQL
            SELECT `UF_POST`, COUNT(*)
            FROM `{$table}`
            WHERE `UF_POST` IN ({$postId})
            GROUP BY `UF_POST`;
        SQL;
        $result = \Bitrix\Main\Application::getConnection()->query($query);
        $votesCount = [];
        while ($item = $result->fetch()) {
            $votesCount[$item['UF_POST']] = $item['COUNT(*)'];
        }

        return $votesCount;
    }

    public function saveVote()
    {
        global $APPLICATION;
        $APPLICATION->RestartBuffer();

        try {
            $currentIp = $this->getIp();
    
            if (empty($currentIp)) {
                die(json_encode(['success' => false, 'message' => 'Не удалось определить IP-адрес']));
            }
    
            $vote = $this->entityClass::getRow([
                'filter' => [
                    '=UF_IP_ADDRESS' => $currentIp
                ]
            ]);
            if (!empty($vote)) {
                die(json_encode(['success' => false, 'message' => 'Вы уже голосовали']));
            }

            $result = $this->entityClass::add([
                'UF_IP_ADDRESS' => $currentIp,
                'UF_POST' => intval($this->request->get('post_id'))
            ]);
    
            if (!$result->isSuccess()) {
                die(json_encode(['success' => false, 'message' => 'Не удалось сохранить голос. Попробуйте позднее.']));
            }
        } catch (\Throwable $e) {
            die(json_encode(['success' => false, 'message' => 'Не удалось сохранить голос. Попробуйте позднее.']));
        }

        die(json_encode(['success' => true, 'message' => 'Ваш голос учтен']));
    }

    public function getIp()
    {
        $server = \Bitrix\Main\Application::getInstance()->getContext()->getServer();
        $ip = '';

        if (!empty($server->get('HTTP_CLIENT_IP'))) {
            $ip = filter_var($server->get('HTTP_CLIENT_IP'), FILTER_VALIDATE_IP);
        } elseif (!empty($server->get('HTTP_X_FORWARDED_FOR'))) {
            $ip = filter_var($server->get('HTTP_X_FORWARDED_FOR'), FILTER_VALIDATE_IP);
        } elseif (!empty($server->getRemoteAddr())) {
            $ip = filter_var($server->getRemoteAddr(), FILTER_VALIDATE_IP);
        }

        return $ip;
    }
}