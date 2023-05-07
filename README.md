# 3IT-WAP-SI-Blockchain
Blockchain-Based Úložiště
Jedná se o jednoduchou implementaci blockchain-based úložiště v PHP. Systém se skládá ze dvou tříd - Block a Chain - které spolu pracují na vytvoření řetězce bloků, které ukládají data.

Popis
Třída Block reprezentuje jediný blok v řetězci. Každý blok má ID, obsah, hash a datum a čas uzavření. Obsah je jednoduše řetězec reprezentující data, která jsou blokem ukládána. Hash je řetězec, který je generován pomocí hashovací funkce (v tomto případě SHA256) a slouží k propojení bloku s předchozím blokem v řetězci. Datum a čas uzavření jsou čas, kdy je blok přidán do řetězce.

Třída Chain reprezentuje celý blockchain. Obsahuje pole objektů Block, které reprezentují řetězec bloků. Třída Chain poskytuje metody pro přidávání nových bloků do řetězce, získávání bloků podle ID, získávání posledního bloku v řetězci a ověřování platnosti řetězce.

Návod pro vývojáře
Pro použití blockchain-based úložiště ve vaší PHP aplikaci postupujte následujícím způsobem:

Zkopírujte třídy Block a Chain do vašeho projektu.
Vytvořte nový objekt Chain: $chain = new Chain();
Vytvořte nový objekt Block se svými daty: $block = new Block(1, 'Data, která se budou ukládat', new DateTime());
Přidejte blok do řetězce: $chain->addBlock($block);
Zkontrolujte platnost řetězce: $chain->isValid();




User
![20230507_145723 (1)](https://user-images.githubusercontent.com/95975878/236679462-11f38835-89cf-4c54-9823-4d14e4795cd7.jpg)
