<?php

class Add_password_hash_to_users
{
    private $_lava;

    public function __construct()
    {
        $this->_lava = lava_instance();
        $this->_lava->call->database();
    }

    public function up()
    {
        $columns = $this->_lava->db->raw('SHOW COLUMNS FROM users LIKE "password_hash"')->fetchAll(PDO::FETCH_ASSOC);
        if (empty($columns)) {
            $this->_lava->db->raw('ALTER TABLE users ADD password_hash VARCHAR(255) NULL AFTER username');
        }
    }

    public function down()
    {
        $this->_lava->db->raw('ALTER TABLE users DROP COLUMN password_hash');
    }
}