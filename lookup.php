<?php
if(isset($_GET["SimID"]))
{
$cn=trim($_GET["SimID"]);
}
$host = "ldap-ad.messiah.edu";
$base = "dc=ad,dc=messiah,dc=edu";
$ldapUser = "cn=phpLDAP,cn=users,dc=ad,dc=messiah,dc=edu";
$ldapPass = "GreenGoblin";
$connect = ldap_connect ($host);
ldap_set_option($connect, LDAP_OPT_REFERRALS, 0);
ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3);
if ($connect)
{
$bind = @ldap_bind($connect,$ldapUser,$ldapPass);
if ($bind) {
} else {
        echo "User Lookup Failed";
}
$filter = "(&(cn={$cn}))";
$search = ldap_search($connect,$base,$filter) or die ("Error in Search:".ldap_error($connect)) ;
$result = ldap_get_entries($connect,$search);
}
if (isset($result[0]['displayname']))
{
echo $result[0]['displayname'][0];
}
?>
