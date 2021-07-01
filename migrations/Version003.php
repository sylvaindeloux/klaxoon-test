<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version003 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add unique flag to tags names';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6FBC94265E237E06 ON tags (name)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP INDEX UNIQ_6FBC94265E237E06 ON tags');
    }
}
