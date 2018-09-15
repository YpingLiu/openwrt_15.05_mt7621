#
# Copyright (C) 2011 OpenWrt.org
#
# This is free software, licensed under the GNU General Public License v2.
# See /LICENSE for more information.
#

define Profile/Default
	NAME:=Default Profile
	PACKAGES:=\
		kmod-usb-core kmod-usb3 \
		kmod-ledtrig-usbdev \
		kmod-ata-core kmod-ata-ahci \
		kmod-ide-core kmod-ide-generic \
		kmod-scsi-core kmod-scsi-generic \
		kmod-crypto-hash kmod-fs-exportfs \
		kmod-fs-ext4 kmod-fs-ntfs kmod-fs-vfat \
		kmod-fuse kmod-lib-crc16 kmod-nls-cp437 \
		kmod-nls-iso8859-1 kmod-nls-utf8 \
		kmod-usb-ohci kmod-usb-storage kmod-usb-storage-extras kmod-usb-uhci kmod-usb2 \
		block-mount libsqlite3 samba36-server ntfs-3g fdisk mount-utils uhttpd uhttpd-mod-ubus \
		php5 php5-cgi php5-mod-ctype php5-mod-hash php5-mod-pdo php5-mod-pdo-sqlite \
		php5-mod-session php5-mod-sqlite3 php5-mod-tokenizer php5-mod-xml \
		vsftpd
endef

define Profile/Default/Description
	Default package set compatible with most boards.
endef
$(eval $(call Profile,Default))
