export COMPOSER_PROCESS_TIMEOUT=1200

composer self-update
cd /vagrant
if [ ! -f build.local.properties ]; then
    cp build.vagrant.properties build.local.properties
fi
ant

if [ ! -f web/config.php ]; then
    ant -f build-dev.xml -Dmysql.root.user=root -Dmysql.root.password=root -Dmoodle.create-database=1 moodle-automation-install
fi
