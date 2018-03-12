select product.*, jsonb_agg(attribute.*) attributes
from product
left join product_attribute using (product_id)
left join (select attribute.*, row_to_json(f.*) as family from attribute inner join family f using(family_id)) attribute using (attribute_id)
where product.product_id = $1
and product.product_id > 2
group by product.product_id
