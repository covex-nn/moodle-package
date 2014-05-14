export COMPOSER_PROCESS_TIMEOUT=1200

composer self-update
cd /vagrant
if [ ! -f build.local.properties ]; then
    cp build.vagrant.properties build.local.properties
fi
ant
