set -e

echo "CREATE FILE ENV"
mv _.env .env
echo "CLEAN CACHE CLEAR"php bin/console cache:clear
rm -fr var/cache