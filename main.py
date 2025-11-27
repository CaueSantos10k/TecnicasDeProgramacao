import os

tarefas = []

def limpar_tela():
    os.system('cls' if os.name == 'nt' else 'clear')

def criar_tarefa():
    nome = input("Digite a descrição da tarefa: ")
    tarefas.append(nome)
    print("Tarefa adicionada com sucesso!")

def ler_tarefas():
    print("--- Lista de Tarefas ---")
    if not tarefas:
        print("Nenhuma tarefa cadastrada.")
    else:
        for i, tarefa in enumerate(tarefas):
            print(f"{i + 1}. {tarefa}")
    input("\nPressione Enter para continuar...")

def atualizar_tarefa():
    ler_tarefas()
    if tarefas:
        try:
            indice = int(input("Digite o número da tarefa para editar: ")) - 1
            if 0 <= indice < len(tarefas):
                nova_descricao = input("Digite a nova descrição: ")
                tarefas[indice] = nova_descricao
                print("Tarefa atualizada!")
            else:
                print("Número inválido.")
        except ValueError:
            print("Por favor, digite um número válido.")

def deletar_tarefa():
    ler_tarefas()
    if tarefas:
        try:
            indice = int(input("Digite o número da tarefa para remover: ")) - 1
            if 0 <= indice < len(tarefas):
                removido = tarefas.pop(indice)
                print(f"Tarefa '{removido}' removida.")
            else:
                print("Número inválido.")
        except ValueError:
            print("Número inválido.")

def menu():
    while True:
        limpar_tela()
        print("=== SISTEMA CRUD DE TAREFAS ===")
        print("1. Adicionar Tarefa (Create)")
        print("2. Listar Tarefas (Read)")
        print("3. Atualizar Tarefa (Update)")
        print("4. Remover Tarefa (Delete)")
        print("5. Sair")
        
        opcao = input("Escolha uma opção: ")
        
        if opcao == '1':
            criar_tarefa()
        elif opcao == '2':
            ler_tarefas()
        elif opcao == '3':
            atualizar_tarefa()
        elif opcao == '4':
            deletar_tarefa()
        elif opcao == '5':
            print("Saindo...")
            break
        else:
            print("Opção inválida!")

if __name__ == "__main__":
    menu()