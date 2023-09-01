<?php

namespace Sprint\Migration;


class accesses_agent20230901113005 extends Version
{
    protected $description = "Очистка просроченных доступов";

    protected $moduleVersion = "4.2.4";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $helper->Agent()->saveAgent(
            array(
                'MODULE_ID' => 'main',
                'USER_ID' => NULL,
                'SORT' => '0',
                'NAME' => 'clearAccesses();',
                'ACTIVE' => 'Y',
                'NEXT_EXEC' => '02.09.2023 11:28:00',
                'AGENT_INTERVAL' => '86400',
                'IS_PERIOD' => 'Y',
                'RETRY_COUNT' => '0',
            )
        );
    }

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function down()
    {
        $helper = $this->getHelperManager();
        $helper->Agent()->deleteAgentIfExists('main', 'clearAccesses();');
    }
}