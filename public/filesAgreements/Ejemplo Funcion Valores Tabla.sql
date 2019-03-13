go
CREATE function demo2()
returns @demo table (
personid INT, 
Name Varchar(250),
demo2 Varchar(250))
as
begin

insert into  @demo
SELECT val.PersonID, val.FirstName, val.JobTitle FROM [dbo].[ufnGetContactInformation] (7) val

insert into  @demo
SELECT val.PersonID, val.FirstName, val.JobTitle FROM [dbo].[ufnGetContactInformation] (8) val

return;
end
go

select * from demo2()