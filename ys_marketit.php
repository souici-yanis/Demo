<?php

define('_PS_COUNTRY_', Configuration::get('PS_COUNTRY_DEFAULT'));

if (!defined('_PS_VERSION_')) {
    exit;
}

class Ys_MarketIt extends Module
{
    public function __construct()
    {
        $this->name = 'ys_marketit';
        $this->version = '1.0.0';
        $this->author = 'Yanis Souici';
        $this->tab = 'front_office_features';
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('YS Market It');
        $this->description = $this->l('Ajoute automatiquement le programme Apollon pour Market-It.');
    }

    public function install()
    {
        return parent::install() &&
            $this->registerHook('actionCustomerAccountAdd');
    }

    public function hookActionCustomerAccountAdd($params)
    {
        $customer = $params['newCustomer'];

        if ($customer->id_default_group == 8) {
            $db = Db::getInstance();
            $sql = "INSERT INTO `ps_ws_bodytime_program_user` (`id_program_user`, `id_customer`, `id_program`, `id_body_shape`, `begin_date`, `diet_type`, `index_day_last_session`, `enabled`) VALUES (NULL, '$customer->id', '3', NULL, NULL, NULL, NULL, '1')";
            $db->execute($sql);
        }
    }
}
