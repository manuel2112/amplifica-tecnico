<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Signifly\Shopify\Shopify;

class UtilityController extends Controller
{
    public function exportExcelProducts(Shopify $shopify)
    {
        $helper = new Sample;
        if ($helper->isCli()) {
            $helper->log('This example should only be run from a Web Browser'.PHP_EOL);

            return;
        }
        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet;

        // Set document properties
        $spreadsheet->getProperties()->setCreator('Manuel Vargas')
            ->setLastModifiedBy('Amplifica')
            ->setTitle('Office 2007 XLSX Test Document')
            ->setSubject('Office 2007 XLSX Test Document')
            ->setDescription('Excel creado con PHP.')
            ->setKeywords('office 2007 openxml php')
            ->setCategory('Listado de productos');

        $products = $shopify->getProducts();
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', '#')
            ->setCellValue('B1', 'Nombre')
            ->setCellValue('C1', 'SKU(ID)')
            ->setCellValue('D1', 'Precio')
            ->setCellValue('E1', 'Imagen');

        foreach ($spreadsheet->getActiveSheet()->getColumnIterator() as $column) {
            $spreadsheet->getActiveSheet()->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
        }

        $i = 2;
        foreach ($products as $product) {
            $spreadsheet->getActiveSheet()
                ->setCellValue('A'.$i, $i - 1)
                ->setCellValue('B'.$i, $product->title)
                ->setCellValue('C'.$i, $product->id.' ')
                ->setCellValue('D'.$i, $product->variants[0]['price'])
                ->setCellValue('E'.$i, $product->image['src']);
            $i++;
        }

        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Hoja 1');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="productos_'.date('Y-m-d H:i:s').'.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }

    public function exportExcelOrders(Shopify $shopify)
    {
        $helper = new Sample;
        if ($helper->isCli()) {
            $helper->log('This example should only be run from a Web Browser'.PHP_EOL);

            return;
        }
        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet;

        // Set document properties
        $spreadsheet->getProperties()->setCreator('Manuel Vargas')
            ->setLastModifiedBy('Amplifica')
            ->setTitle('Office 2007 XLSX Test Document')
            ->setSubject('Office 2007 XLSX Test Document')
            ->setDescription('Excel creado con PHP.')
            ->setKeywords('office 2007 openxml php')
            ->setCategory('Listado de pedidos');

        $orders = $shopify->getOrders();
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', '#')
            ->setCellValue('B1', 'ID')
            ->setCellValue('C1', 'Cliente')
            ->setCellValue('D1', 'Fecha')
            ->setCellValue('E1', 'Monto')
            ->setCellValue('F1', 'Estado')
            ->setCellValue('G1', 'Detalle');

        $i = 2;
        foreach ($orders as $order) {

            $detail = '';
            foreach ($order->line_items as $item) {
                $detail .= '- '.$item['current_quantity'].' x '.$item['name'].PHP_EOL;
            }

            foreach ($spreadsheet->getActiveSheet()->getColumnIterator() as $column) {
                $spreadsheet->getActiveSheet()->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
            }
            $spreadsheet->getActiveSheet()->getStyle('G')->getAlignment()->setWrapText(true);
            $spreadsheet->getActiveSheet()
                ->setCellValue('A'.$i, $i - 1)
                ->setCellValue('B'.$i, $order->id.' ')
                ->setCellValue('C'.$i, $order->customer['id'].' ')
                ->setCellValue('D'.$i, Carbon::parse($order->created_at)->format('d/m/Y H:i:s'))
                ->setCellValue('E'.$i, $order->current_total_price)
                ->setCellValue('F'.$i, $order->financial_status == 'paid' ? 'Pagado' : 'Pendiente')
                ->setCellValue('G'.$i, $detail);
            $i++;
        }

        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Hoja 1');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="pedidos_'.date('Y-m-d H:i:s').'.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }
}
