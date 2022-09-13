<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220913071057 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actions_log DROP FOREIGN KEY actions_log_action_id_foreign');
        $this->addSql('ALTER TABLE actions_log CHANGE chat_id chat_id BIGINT UNSIGNED DEFAULT NULL, CHANGE action_id action_id BIGINT UNSIGNED DEFAULT NULL, CHANGE block_id block_id BIGINT UNSIGNED DEFAULT NULL');
        $this->addSql('ALTER TABLE actions_log ADD CONSTRAINT FK_B08408349D32F035 FOREIGN KEY (action_id) REFERENCES actions (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actions_log DROP FOREIGN KEY FK_B08408349D32F035');
        $this->addSql('ALTER TABLE actions_log CHANGE action_id action_id BIGINT UNSIGNED DEFAULT NULL COMMENT \'ID блока из таблицы actions\', CHANGE block_id block_id BIGINT UNSIGNED DEFAULT NULL COMMENT \'ID блока из таблицы blocks\', CHANGE chat_id chat_id BIGINT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE actions_log ADD CONSTRAINT actions_log_action_id_foreign FOREIGN KEY (action_id) REFERENCES actions (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
