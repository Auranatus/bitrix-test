<?php


class PostListComponent extends CBitrixComponent
{
    public function executeComponent()
    {
        $this->getPosts();

        $this->includeComponentTemplate();
    }

    public function getPosts()
    {
        $cache = \Bitrix\Main\Data\Cache::createInstance();

        $nav = new \Bitrix\Main\UI\PageNavigation('posts');
        $nav->allowAllRecords(true)
            ->setPageSize(3)
            ->initFromUri();

        if ($cache->initCache(86400, 'post_list_page_' . $nav->getCurrentPage() ?? 1)) {
            $this->arResult = $cache->getVars();
        } else {
            $cache->startDataCache();

            try {
                $hlBlock = \Bitrix\Highloadblock\HighloadBlockTable::getById(POSTS_HL_BLOCK_ID)->fetch();
                $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlBlock);
                $entityClass = $entity->getDataClass();

                $dbPosts = $entityClass::getList([
                    'order' => ['ID' => 'ASC'],
                    'count_total' => true,
                    'offset' => $nav->getOffset(),
                    'limit' => $nav->getLimit(),
                ]);

                $nav->setRecordCount($dbPosts->getCount());

                while ($post = $dbPosts->fetch()) {
                    $this->arResult['POSTS'][] = $post;
                }
                $this->arResult['NAV'] = $nav;
            } catch (\Throwable $e) {}

            if (empty($this->arResult['POSTS'])) {
                $cache->abortDataCache();
            }

            $cache->endDataCache($this->arResult);
        }
    }
}