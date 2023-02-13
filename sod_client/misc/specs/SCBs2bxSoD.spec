Summary: S2BX Start of Day Report
Name: SCBs2bxSoD
Version: 2.0
Release: 0
Group: Applications/System
License: Standard Chartered Bank
URL: N/A
Source0: %{name}-%{version}.tar.gz
Packager: Adrian Brady

BuildRoot: /devshared/home/u1537349/rpmbuild/%{name}-%{version}

%description
Suite of scripts to check server configuration, status and generate a local report.

%prep
%setup -n SCBs2bxSoD

%build
# Empty section.

%install
rm -rf "$RPM_BUILD_ROOT"
mkdir -p "$RPM_BUILD_ROOT"/opt/s2bxSoD
cp -R * "$RPM_BUILD_ROOT"/opt/s2bxSoD

%files
/opt/s2bxSoD

%post

CronEntry=`grep run-S2BX-SoD /var/spool/cron/root`
if [ "$CronEntry" = "" ]; then
  /bin/echo "0 6,23 * * * /opt/s2bxSoD/run-S2BX-SoD 1>/dev/null 2>&1" >> /var/spool/cron/root
else
  /bin/cat /var/spool/cron/root | grep s2bxSoD | sed -i s"@0 3@0 6,23@g" /var/spool/cron/root
fi

%postun
/bin/cat /var/spool/cron/root | sed -i  '/run-S2BX-SoD/d' /var/spool/cron/root

%clean
rm -rf $RPM_BUILD_ROOT

%changelog
