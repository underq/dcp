class Node {

    constructor(value, parent = null) {
        this.value = value;
        this.parent = parent;
        this.left = null;
        this.right = null;
        this.lock = false;
    }
}

class BinaryTree {

    constructor(value) {
        this.root = new Node(value);
    }

    *preOrderTraversal(node = this.root) {
        yield node;
        if (node.left) yield* this.preOrderTraversal(node.left);
        if (node.right) yield* this.preOrderTraversal(node.right);
    }

    *postOrderTraversal(node = this.root) {
        if (node.left) yield* this.postOrderTraversal(node.left);
        if (node.right) yield* this.postOrderTraversal(node.right);
        yield node;
    }

    *inOrderTraversal(node = this.root) {
        if (node.left) yield* this.postOrderTraversal(node.left);
        yield node;
        if (node.right) yield* this.postOrderTraversal(node.right);
    }

    insert(parentNode, value, { left, right } = { left: true, right: true }) {
        for (let node of this.preOrderTraversal()) {
            //if (parentNode === 'child2') console.log(node);
            if (node.value === parentNode) {
                const canInsertLeft = left && node.left === null;
                const canInsertRight = right && node.right === null;
                if (!canInsertLeft && !canInsertRight) return false;
                if (canInsertLeft) {
                    node.left = new Node(value, node);
                    return true;
                  }
                  if (canInsertRight) {
                    node.right = new Node(value, node);
                    return true;
                  }
            }
        }
    }

    find(value) {
        for (let node of this.preOrderTraversal()) {
          if (node.value === value) return node;
        }
        return undefined;
    }

    lock(value) {
        let node = this.find(value);
        if (node === undefined || !this.canBelock(node)) {
            return false;
        }

        node.lock = true;
        return true;
    }

    unlock(value) {
        let node = this.find(value);
        if (node === undefined || !this.canBelock(node)) {
            return false;
        };

        node.lock = false;
        return true;
    }

    canBelock(value) {
        for (let node of this.preOrderTraversal(value)) {
            if (node !== value && node.lock) {
                return false;
            } 
        }
        return true;
    }

}


const tree = new BinaryTree('root');

tree.insert('root', 'child1');
tree.insert('root', 'child1Bis');
//tree.insert('child1', 'child2');
//tree.insert('child2', 'child3');


console.log(tree.lock('root'));
console.log(tree.lock('child1'));
console.log(tree.unlock('root'));
console.log(tree.unlock('child1'));
console.log(tree.unlock('root'));

console.log(tree);
