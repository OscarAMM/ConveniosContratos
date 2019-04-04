Use AdventureWorks2012
GO

CREATE OR ALTER FUNCTION priceComponent(@price money, @quantity decimal(8,2))
RETURNS  MONEY
AS
BEGIN
	DECLARE @total Money
	SET @total = @price * @quantity
	RETURN @total
END

GO
CREATE OR ALTER FUNCTION MateriialList(@ProductFinalId int)
RETURNS TABLE
AS
RETURN (
	SELECT p.ProductId, p.Name, b.PerAssemblyQty as Quantity, dbo.priceComponent(P.StandardCost, b.PerAssemblyQty) as Cost, BOMLevel as Level FROM Production.BillOfMaterials as b
	JOIN Production.Product as p ON p.ProductID = b.ComponentID
	WHERE p.MakeFlag = 1 AND b.ProductAssemblyID = @ProductFinalId
)

GO
SELECT * FROM dbo.MateriialList(771)


 
 