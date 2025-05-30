<?php
include_once 'Canal.php';
include_once 'Cliente.php';
include_once 'Contrato.php';
include_once 'cWeb.php';
include_once 'Plan.php';
include_once 'EmpresaCable.php';

$unCliente= new Cliente("Carla", "Lopez", "DNI", 21111111);
$otroCliente= new Cliente("Juan", "Perez", "DNI", 18888888);
$ultCliente= new Cliente("Noe", "Morales", "DNI", 33333333 );

$unCanal= new Canal("noticia", 12, true);
$otroCanal= new Canal("deportivo", 22, true);
$ultCanal= new Canal("infantil", 10, false);


$unPlan= new Plan(1,[$unCanal,$otroCanal,$ultCanal], 10000);

$cont1= new Contrato(1,"05/05/2025", "04/06/2025", $unPlan, "al dia", 4200, true, $unCliente);
$cont2= new ContratoWeb(2,"05/05/2025", "04/06/2025", $unPlan,"al dia", 4200, true,$otroCliente);
$con3= new ContratoWeb(3,"05/05/2025", "04/06/2025", $unPlan,"al dia", 4200, true, $ultCliente);

echo "Importe final primer contrato: $" . $cont1->calcularImporte();
echo "Importe final primer contrato: $" . $cont2->calcularImporte();
echo "Importe final primer contrato: $" . $cont3->calcularImporte();

$miEmpresa= new EmpresaCable();

$miEmpresa->incorporarPlan($unPlan);
$miEmpresa->incorporarContrato($unPlan,$unCliente, "30/05/2025", "30/06/2025", false);
$miEmpresa->incorporarContrato($unPlan,$otroCliente, "30/05/2025", "30/06/2025",true);

$miEmpresa->pagarContrato($con1);
$miEmpresa->pagarContrato($con2);

$miEmpresa->retornarPromImporteContratos(111);

?>