Role Name
=========

This role installs Postgres on /postgres directory using the apps volumegroup.
It configures the dbservices repo for use to install postgres and dependent rpms

Requirements
------------

This Role requires appsvg with 5GB of free space from the volume group.

Role Variables
--------------

The role has 3 variables used
 1. pgresvars -- Has the lv details mount pount and size 
 2. pgresdirs -- This has the directories that needs to be created under /postgres and required permission
 3. pgresrpm -- Postgress related rpm 

Dependencies
------------

This has no dependencies on any other playbooks

Example Playbook
----------------

/usr/bin/ansible-pull --full -C master -d /root/ansible -i inventory -U https://bitbucket/code.git --purge build/PostGres.yml


License
-------

BSD

Author Information
------------------

An optional section for the role authors to include contact information, or a website (HTML is not allowed).
