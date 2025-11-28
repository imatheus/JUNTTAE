# 💡 Exemplos de Uso - Rotina do Cliente

## 🎯 Cenários Práticos

### Cenário 1: Cliente Comprando Ingresso para um Show

**Situação:** Maria quer comprar ingressos para um show de música.

**Passo a Passo:**

1. **Login**
   ```
   Maria acessa: http://seusite.com
   Faz login com: maria@email.com
   Tipo de usuário: 'usuario'
   ```

2. **Ver Eventos**
   ```
   Sistema redireciona para: /usuario/dashboard
   Maria vê: "Show de Rock - Banda XYZ"
   Data: 15/02/2025 às 20:00
   Local: Arena Central
   Valor: R$ 50,00
   Disponíveis: 100 ingressos
   ```

3. **Ver Detalhes**
   ```
   Maria clica em: "Ver Detalhes"
   Vê descrição completa do show
   Vê que ainda há 100 ingressos disponíveis
   Clica em: "Comprar Ingressos"
   ```

4. **Comprar**
   ```
   Seleciona: 2 ingressos
   Valor total calculado: R$ 100,00
   Clica em: "Confirmar Compra"
   ```

5. **Confirmação**
   ```
   Recebe código: COMP-A1B2C3D4
   Vê mensagem: "Compra realizada com sucesso!"
   Vê botão: "Entrar no Grupo WhatsApp"
   ```

6. **Grupo WhatsApp**
   ```
   Clica no botão
   É redirecionada para: https://chat.whatsapp.com/xxxxx
   Entra no grupo do evento
   ```

---

### Cenário 2: Cliente Verificando Seus Ingressos

**Situação:** João comprou ingressos para 3 eventos diferentes e quer verificar.

**Passo a Passo:**

1. **Acessar Ingressos**
   ```
   João faz login
   Clica em: "Meus Ingressos" (no header)
   ```

2. **Visualizar Lista**
   ```
   Vê 3 eventos:
   
   1. Show de Rock - Banda XYZ
      Código: COMP-A1B2C3D4
      Data: 15/02/2025
      2 ingressos - R$ 100,00
      [Ver Detalhes] [Grupo WhatsApp]
   
   2. Workshop de Fotografia
      Código: COMP-E5F6G7H8
      Data: 20/02/2025
      1 ingresso - R$ 80,00
      [Ver Detalhes]
   
   3. Feira de Artesanato
      Código: COMP-I9J0K1L2
      Data: 25/02/2025
      3 ingressos - R$ 45,00
      [Ver Detalhes] [Grupo WhatsApp]
   ```

3. **Acessar Grupo**
   ```
   Clica em "Grupo WhatsApp" do Show de Rock
   Entra no grupo
   ```

---

### Cenário 3: Curador Criando Evento com Grupo WhatsApp

**Situação:** Pedro é curador e quer criar um workshop com grupo WhatsApp.

**Passo a Passo:**

1. **Login como Curador**
   ```
   Pedro acessa o sistema
   Login: pedro@email.com
   Tipo: 'curador'
   Redireciona para: /curador/dashboard
   ```

2. **Criar Evento**
   ```
   Clica em: "Cadastrar Novo Evento"
   Preenche:
   - Título: Workshop de Fotografia
   - Categoria: Workshop
   - Data: 20/02/2025 14:00
   - Local: Estúdio Foto Arte
   - Valor: R$ 80,00
   - Ingressos: 20
   - Descrição: "Aprenda técnicas profissionais..."
   - Imagem: [upload da foto]
   - Link WhatsApp: https://chat.whatsapp.com/xxxxx
   ```

3. **Salvar**
   ```
   Clica em: "Salvar Evento"
   Evento criado com sucesso!
   Agora clientes podem comprar e entrar no grupo
   ```

---

### Cenário 4: Tentativa de Compra Duplicada (Validação)

**Situação:** Ana tenta comprar ingressos para um evento que já comprou.

**Passo a Passo:**

1. **Primeira Compra**
   ```
   Ana compra 2 ingressos para "Show de Rock"
   Código gerado: COMP-M3N4O5P6
   Compra confirmada ✓
   ```

2. **Tentativa de Segunda Compra**
   ```
   Ana volta ao evento
   Clica em: "Comprar Ingressos"
   Sistema detecta compra anterior
   Redireciona para detalhes do evento
   Mostra mensagem: "Você já possui ingressos para este evento."
   Mostra botão: "Ver Meus Ingressos"
   ```

3. **Resultado**
   ```
   Ana não consegue comprar novamente ✓
   Pode ver seus ingressos existentes
   Pode acessar o grupo WhatsApp
   ```

---

### Cenário 5: Evento com Ingressos Esgotados

**Situação:** Carlos tenta comprar ingressos para um evento lotado.

**Passo a Passo:**

1. **Ver Evento**
   ```
   Carlos acessa: "Festival de Música"
   Vê: "Disponíveis: 0 de 100"
   Botão "Comprar Ingressos" não aparece
   ```

2. **Mensagem**
   ```
   Sistema mostra:
   "❌ Ingressos Esgotados"
   Não permite compra
   ```

---

### Cenário 6: Compra de Múltiplos Ingressos

**Situação:** Fernanda quer comprar ingressos para ela e amigos.

**Passo a Passo:**

1. **Selecionar Quantidade**
   ```
   Fernanda acessa: "Feira de Artesanato"
   Clica em: "Comprar Ingressos"
   Seleciona: 5 ingressos
   ```

2. **Cálculo Automático**
   ```
   Valor unitário: R$ 15,00
   Quantidade: 5
   Valor total: R$ 75,00 (calculado automaticamente)
   ```

3. **Confirmação**
   ```
   Clica em: "Confirmar Compra"
   Código: COMP-Q7R8S9T0
   5 ingressos confirmados
   ```

---

## 🔍 Casos de Teste

### Teste 1: Validação de Disponibilidade

**Cenário:**
- Evento tem 10 ingressos
- 8 já foram vendidos
- Cliente tenta comprar 5

**Resultado Esperado:**
```
❌ Erro: "Quantidade de ingressos indisponível. Disponíveis: 2"
Compra não é processada
Cliente pode ajustar quantidade
```

---

### Teste 2: Acesso ao Grupo sem Compra

**Cenário:**
- Cliente não comprou ingresso
- Tenta acessar grupo WhatsApp diretamente

**Resultado Esperado:**
```
❌ Erro: "Você precisa comprar um ingresso para acessar o grupo."
Redireciona para detalhes do evento
```

---

### Teste 3: Evento sem Grupo WhatsApp

**Cenário:**
- Cliente comprou ingresso
- Evento não tem grupo configurado
- Tenta acessar grupo

**Resultado Esperado:**
```
❌ Erro: "Este evento ainda não possui um grupo do WhatsApp."
Redireciona para detalhes do evento
```

---

## 📱 Fluxos de Navegação

### Fluxo 1: Compra Completa

```
Login
  ↓
Dashboard (/usuario/dashboard)
  ↓
Ver Detalhes (/eventos/1)
  ↓
Comprar (/eventos/1/comprar)
  ↓
Confirmar Compra (POST /eventos/1/comprar)
  ↓
Sucesso (/compra/1/sucesso)
  ↓
Grupo WhatsApp (/eventos/1/grupo-whatsapp)
  ↓
WhatsApp (redirecionamento externo)
```

### Fluxo 2: Gerenciar Ingressos

```
Login
  ↓
Meus Ingressos (/meus-ingressos)
  ↓
Ver Detalhes do Evento (/eventos/1)
  ↓
Grupo WhatsApp (/eventos/1/grupo-whatsapp)
```

---

## 💻 Exemplos de Código

### Verificar se Usuário Comprou Ingresso

```php
// No Controller ou View
$hasPurchased = Auth::user()->hasPurchasedEvent($eventId);

if ($hasPurchased) {
    // Mostrar botão do grupo WhatsApp
} else {
    // Mostrar botão de comprar
}
```

### Calcular Ingressos Disponíveis

```php
// No Model Event
$event = Event::find($id);
$available = $event->availableTickets();

echo "Disponíveis: {$available} de {$event->ingressos}";
```

### Gerar Código de Compra

```php
// Automático ao criar Purchase
$purchase = Purchase::create([
    'user_id' => Auth::id(),
    'event_id' => $eventId,
    'quantidade' => $quantidade,
    'valor_total' => $valorTotal,
    'status' => 'confirmado',
    'codigo_compra' => Purchase::generateCodigoCompra(),
]);

// Código gerado: COMP-A1B2C3D4
```

---

## 🎨 Exemplos de Interface

### Dashboard do Cliente

```
┌─────────────────────────────────────────────┐
│  JUNTTAE - Eventos Disponíveis              │
│                          [Meus Ingressos]   │
├─────────────────────────────────────────────┤
│                                             │
│  ┌──────────┐  ┌──────────┐  ┌──────────┐ │
│  │ [Imagem] │  │ [Imagem] │  │ [Imagem] │ │
│  │          │  │          │  │          │ │
│  │ Show     │  │ Workshop │  │ Feira    │ │
│  │ R$ 50,00 │  │ R$ 80,00 │  │ R$ 15,00 │ │
│  │ 100/100  │  │ 15/20    │  │ 50/100   │ │
│  │[Detalhes]│  │[Detalhes]│  │[Detalhes]│ │
│  └──────────┘  └──────────┘  └──────────┘ │
│                                             │
└─────────────────────────────────────────────┘
```

### Página de Compra

```
┌─────────────────────────────────────────────┐
│  Comprar Ingressos                          │
│                              [← Voltar]     │
├─────────────────────────────────────────────┤
│                                             │
│  Show de Rock - Banda XYZ                   │
│                                             │
│  📅 Data: 15/02/2025 20:00                  │
│  📍 Local: Arena Central                    │
│  💰 Valor: R$ 50,00                         │
│  🎟️ Disponíveis: 100                        │
│                                             │
│  Quantidade: [2] ▼                          │
│                                             │
│  ┌─────────────────────────────────────┐   │
│  │ Valor Total: R$ 100,00              │   │
│  └─────────────────────────────────────┘   │
│                                             │
│  [Cancelar]  [Confirmar Compra]            │
│                                             │
└─────────────────────────────────────────────┘
```

---

## 📊 Dados de Exemplo

### Usuários

```sql
-- Cliente
INSERT INTO users (name, email, password, tipo_usuario) VALUES
('Maria Silva', 'maria@email.com', 'hash...', 'usuario');

-- Curador
INSERT INTO users (name, email, password, tipo_usuario) VALUES
('Pedro Santos', 'pedro@email.com', 'hash...', 'curador');
```

### Eventos

```sql
INSERT INTO events (user_id, titulo, data, local, valor, categoria, ingressos, descricao, whatsapp_group) VALUES
(2, 'Show de Rock', '2025-02-15 20:00:00', 'Arena Central', 50.00, 'Show', 100, 'Show incrível...', 'https://chat.whatsapp.com/xxxxx');
```

### Compras

```sql
INSERT INTO purchases (user_id, event_id, quantidade, valor_total, status, codigo_compra) VALUES
(1, 1, 2, 100.00, 'confirmado', 'COMP-A1B2C3D4');
```

---

## ✅ Checklist de Funcionalidades

- [x] Cliente pode ver eventos
- [x] Cliente pode ver detalhes
- [x] Cliente pode comprar ingressos
- [x] Sistema gera código único
- [x] Cliente pode ver seus ingressos
- [x] Cliente pode acessar grupo WhatsApp
- [x] Sistema valida compras duplicadas
- [x] Sistema valida disponibilidade
- [x] Curador pode adicionar grupo WhatsApp
- [x] Cálculo automático de valor total
- [x] Cálculo dinâmico de ingressos disponíveis

---

**Sistema JUNTTAE - Exemplos de Uso** 🎉
