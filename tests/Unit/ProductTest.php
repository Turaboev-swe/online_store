<?php
namespace Tests\Unit;
use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
class ProductTest extends TestCase
{
    use RefreshDatabase;
    public function test_product_can_be_created()
    {
        $product = Product::factory()->create([
            'name' => 'Electronics',
        ]);
        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals('Electronics', $product->name);
    }
    public function test_product_can_have_products()
    {
        $product = Product::factory()->create();
        $product = Product::factory()->create(['product_id' => $product->id]);
        $this->assertTrue($product->products->contains($product));
        $this->assertEquals(1, $product->products->count());
    }
    public function test_product_can_have_subcategories()
    {
        $parentProduct = Product::factory()->create();
        $subProduct = Product::factory()->create(['parent_id' => $parentProduct->id]);
        $this->assertTrue($parentProduct->subcategories->contains($subProduct));
        $this->assertEquals(1, $parentProduct->subcategories->count());
    }
    public function test_product_name_must_be_unique()
    {
        Product::factory()->create(['name' => 'UniqueName']);
        $this->expectException(QueryException::class);
        Product::factory()->create(['name' => 'UniqueName']);
    }
    public function test_deleting_product_deletes_associated_products()
    {
        $product = Product::factory()->create();
        $product = \App\Models\Product::factory()->create(['product_id' => $product->id]);
        $product->delete();
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
    public function test_product_can_have_parent()
    {
        $parentProduct = Product::factory()->create();
        $childProduct = Product::factory()->create(['parent_id' => $parentProduct->id]);
        $this->assertEquals($parentProduct->id, $childProduct->parent_id);
        $this->assertTrue($parentProduct->subcategories->contains($childProduct));
    }
    public function test_only_fillable_attributes_are_mass_assignable()
    {
        $product = new Product();
        $product->fill([
            'name' => 'Test Product',
            'non_fillable_attribute' => 'Should not be set',
        ]);
        $this->assertEquals('Test Product', $product->name);
        $this->assertArrayNotHasKey('non_fillable_attribute', $product->getAttributes());
    }
}
