<?php

# TODO: Make this an abstract class, and make the EC2 API a subclass
class OpenStackNovaController {

	var $novaConnection;
	var $instances, $images, $keypairs, $availabilityZones;

	var $instanceTypes = array( 't1.micro', 'm1.small', 'm1.large', 'm1.xlarge', 'm2.xlarge', 'm2.2xlarge', 'm2.4xlarge', 'c1.medium', 'c1.xlarge', 'cc1.4xlarge' );

	# TODO: Make disable_ssl, hostname, and resource_prefix config options
	function __construct( $credentials ) {
		global $wgOpenStackManagerNovaDisableSSL, $wgOpenStackManagerNovaServerName,
			$wgOpenStackManagerNovaPort, $wgOpenStackManagerNovaResourcePrefix;
		wfLoadExtensionMessages('OpenStackManager');
		$this->novaConnection = new AmazonEC2( $credentials['accessKey'], $credentials['secretKey'] );
		$this->novaConnection->disable_ssl($wgOpenStackManagerNovaDisableSSL);
		$this->novaConnection->set_hostname($wgOpenStackManagerNovaServerName, $wgOpenStackManagerNovaPort);
		$this->novaConnection->set_resource_prefix($wgOpenStackManagerNovaResourcePrefix);
		$this->instances = array();
	}

	function getInstance( $instanceId, $reload = false ) {
		if ( isset( $this->instances[$instanceId] ) && !$reload ) {
			$instance = $this->instances[$instanceId];
		} else {
			$instance = $this->novaConnection->describe_instances( $instanceId );
			$instance = $instance->body->reservationSet->item;
			$this->instances["$instance->instancesSet->item->instanceId"] = $instance;
		}
		return $instance;
	}

	function getInstances( $reload = false ) {
		if ( count( $this->instances ) == 0 || $reload ) {
			$this->instances = array();
			$instances = $this->novaConnection->describe_instances();
			$instances = $instances->body->reservationSet->item;
			foreach ( $instances as $instance ) {
				$this->instances["$instance->instancesSet->item->instanceId"] = $instance;
			}
		}
		return $this->instances;
	}

	function getInstanceTypes() {
		return $this->instanceTypes;
	}

	function getImages( $reload = false ) {
		if ( count( $this->images ) == 0 || $reload ) {
			$this->images = array();
			$images = $this->novaConnection->describe_images();
			$images = $images->body->imagesSet->item;
			foreach ( $images as $image ) {
				if ( $image->imageType == 'machine' ) {
					$this->images["$image->imageId"] = $image;
				}
			}
		}
		return $this->images;
	}

	# TODO: make this user specific
	function getKeypairs( $reload = false ) {
		if ( count( $this->keypairs ) == 0 || $reload ) {
			$this->keypairs = array();
			$keypairs = $this->novaConnection->describe_key_pairs();
			$keypairs = $keypairs->body->keypairsSet->item;
			foreach ( $keypairs as $keypair ) {
				$this->keypairs["$keypair->keyName"] = $keypair;
			}
		}
		return $this->keypairs;
	}

	function getAvailabilityZones( $reload = false ) {
		if ( count( $this->availabilityZones ) == 0 || $reload ) {
			$this->availabilityZones = array();
			$availabilityZones = $this->novaConnection->describe_availability_zones();
			$availabilityZones = $availabilityZones->body->availabilityZoneInfo->item;
			foreach ( $availabilityZones as $availabilityZone ) {
				if ( $availabilityZones->zoneState == "available" ) {
					$this->availabilityZones["$availabilityZones->zoneName"] = $availabilityZone;
				}
			}
		}
		return $this->availabilityZones;
	}

	function createInstance( $image, $key, $instanceType, $availabilityZone ) {
		# 1, 1 is min and max number of instances to create.
		# We never want to make more than one at a time.
		$instance = $this->novaConnection->run_instances($image, 1, 1, array(
			'KeyName' => $key,
			'InstanceType' => $instanceType,
			'Placement.AvailabilityZone' => $availabilityZone,
		));

		$instance = $instance->body->reservationSet->item;
		$instanceId = $instance->instancesSet->item->instanceId;
		$this->instances["$instanceId"] = $instance;

		return $instanceId;
	}

}
