<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
        $this->call->model('ProductsModel');
        $this->request = Registry::get_object('request');
        $this->response = Registry::get_object('response');
    }

    public function index()
    {
        $products = $this->ProductsModel->query()->order_by('created_at', 'DESC')->get_all() ?: [];
        $this->call->view('products/index', ['products' => $products]);
    }

    public function create()
    {
        $this->call->view('products/form', ['product' => null, 'error' => null]);
    }

    public function store()
    {
        $data = $this->product_data();
        if ($data['error']) {
            $this->call->view('products/form', ['product' => $data['product'], 'error' => $data['error']]);
            return;
        }

        $this->ProductsModel->insert($data['product']);
        $this->response->redirect($this->route_url('/products'));
    }

    public function edit($id)
    {
        $product = $this->ProductsModel->find((int) $id);
        if (!$product) {
            show_404('Product not found', 'The requested product does not exist.');
        }

        $this->call->view('products/form', ['product' => $product, 'error' => null]);
    }

    public function update($id)
    {
        $product = $this->ProductsModel->find((int) $id);
        $data = $this->product_data();
        if (!$product) {
            show_404('Product not found', 'The requested product does not exist.');
        }
        if ($data['error']) {
            $data['product']['id'] = $id;
            $this->call->view('products/form', ['product' => $data['product'], 'error' => $data['error']]);
            return;
        }

        $this->ProductsModel->update((int) $id, $data['product']);
        $this->response->redirect($this->route_url('/products'));
    }

    public function delete($id)
    {
        $this->ProductsModel->delete((int) $id);
        $this->response->redirect($this->route_url('/products'));
    }

    private function product_data()
    {
        $product = [
            'product_name' => trim((string) $this->request->post('product_name')),
            'description' => trim((string) $this->request->post('description')),
            'price' => (float) $this->request->post('price'),
            'quantity' => (int) $this->request->post('quantity'),
        ];
        $error = $product['product_name'] === '' ? 'Product name is required.' : null;
        $error = ($product['price'] < 0 || $product['quantity'] < 0) ? 'Price and quantity cannot be negative.' : $error;

        return ['product' => $product, 'error' => $error];
    }

    private function route_url($path)
    {
        $public_path = rtrim(str_replace('\\', '/', dirname(str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '/'))), '/');
        return ($public_path ?: '') . $path;
    }
}