set -e

echo "Symfony:doctrine:migrations:migrate"
php bin/console doctrine:migrations:migrate --no-interaction

echo "Symfony:cache:clear"
php bin/console cache:clear --env=prod