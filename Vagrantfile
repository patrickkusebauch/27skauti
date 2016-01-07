VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
    config.vm.box = "ubuntu/trusty64"

    # Forward ports to Apache and MySQL
    config.vm.network "forwarded_port", guest: 80, host: 80
    config.vm.network "forwarded_port", guest: 3306, host: 3306

	config.vm.provision "shell", path: "provision.sh"
end
