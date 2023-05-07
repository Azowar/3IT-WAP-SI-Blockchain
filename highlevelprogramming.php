<?php

interface IChain
{
    public function addBlock(Block $block): static;
    public function getBlock(int $id): ?Block;
    public function getLastBlock(): ?Block;
    public function isValid(): bool;
}

class Block
{
    private int $id;
    private string $content;
    private string $hash;
    private DateTime $dttm;

    public function __construct(int $id, string $content, DateTime $dttm)
    {
        $this->id = $id;
        $this->content = $content;
        $this->dttm = $dttm;
        $this->hash = '';
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getHash(): string
    {
        return $this->hash;
    }

    public function getDateTime(): DateTime
    {
        return $this->dttm;
    }

    public function setHash(string $hash): void
    {
        $this->hash = $hash;
    }
}

class Chain implements IChain
{
    private array $blocks;

    public function __construct()
    {
        $this->blocks = array();
    }

    public function addBlock(Block $block): static
    {
        $prevHash = '';
        if (!empty($this->blocks)) {
            $prevBlock = end($this->blocks);
            $prevHash = $prevBlock->getHash();
        }

        $blockData = $block->getContent() . $prevHash . $block->getDateTime()->format('Y-m-d H:i:s');
        $hash = hash('sha256', $blockData);

        $block->setHash($hash);
        $this->blocks[] = $block;

        return $this;
    }

    public function getBlock(int $id): ?Block
    {
        foreach ($this->blocks as $block) {
            if ($block->getId() === $id) {
                return $block;
            }
        }

        return null;
    }

    public function getLastBlock(): ?Block
    {
        return end($this->blocks) ?: null;
    }

    public function isValid(): bool
    {
        $count = count($this->blocks);
        for ($i = 1; $i < $count; ++$i) {
            $prevBlock = $this->blocks[$i - 1];
            $currentBlock = $this->blocks[$i];
            $blockData = $currentBlock->getContent() . $prevBlock->getHash() . $currentBlock->getDateTime()->format('Y-m-d H:i:s');
            $hash = hash('sha256', $blockData);
            if ($hash !== $currentBlock->getHash()) {
                return false;
            }
        }

        return true;
    }
}

$chain = new Chain();
$chain->addBlock(new Block(1, "Varnsdorf", new DateTime()));
$chain->addBlock(new Block(2, "Rumburk", new DateTime()));

var_dump($chain);
echo "Chain " . ($chain->isValid() ? "is" : "is not") . " valid.\n";
echo "Last block content: " . $chain->getLastBlock()->getContent() . "\n";
